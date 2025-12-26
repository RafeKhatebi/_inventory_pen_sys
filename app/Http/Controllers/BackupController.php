<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
    public function index()
    {
        $backups = $this->getBackupFiles();
        return view('backup.index', compact('backups'));
    }

    public function create()
    {
        try {
            $filename = 'backup_' . date('Y_m_d_H_i_s') . '.sql';
            $path = storage_path('app/backups/' . $filename);

            // Create backups directory if it doesn't exist
            if (!file_exists(storage_path('app/backups'))) {
                mkdir(storage_path('app/backups'), 0755, true);
            }

            // Get database configuration
            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');

            // Create mysqldump command
            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > %s',
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($host),
                escapeshellarg($database),
                escapeshellarg($path)
            );

            // Execute the command
            exec($command, $output, $returnVar);

            if ($returnVar === 0 && file_exists($path)) {
                return redirect()->route('backup.index')
                    ->with('success', 'Database backup created successfully: ' . $filename);
            } else {
                return redirect()->route('backup.index')
                    ->with('error', 'Failed to create database backup');
            }
        } catch (\Exception $e) {
            return redirect()->route('backup.index')
                ->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        $path = storage_path('app/backups/' . $filename);

        if (file_exists($path)) {
            return response()->download($path);
        }

        return redirect()->route('backup.index')
            ->with('error', 'Backup file not found');
    }

    public function delete($filename)
    {
        $path = storage_path('app/backups/' . $filename);

        if (file_exists($path)) {
            unlink($path);
            return redirect()->route('backup.index')
                ->with('success', 'Backup deleted successfully');
        }

        return redirect()->route('backup.index')
            ->with('error', 'Backup file not found');
    }

    private function getBackupFiles()
    {
        $backupPath = storage_path('app/backups');

        if (!file_exists($backupPath)) {
            return [];
        }

        $files = scandir($backupPath);
        $backups = [];

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $backups[] = [
                    'name' => $file,
                    'size' => $this->formatBytes(filesize($backupPath . '/' . $file)),
                    'date' => date('Y-m-d H:i:s', filemtime($backupPath . '/' . $file))
                ];
            }
        }

        return array_reverse($backups);
    }

    private function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
}