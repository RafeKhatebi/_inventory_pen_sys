<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function createBackup()
    {
        try {
            $timestamp = now()->format('Y-m-d_H-i-s');
            $filename = "backup_{$timestamp}.sql";
            
            // Simple backup approach - export all data as JSON
            $backup = [
                'timestamp' => $timestamp,
                'users' => DB::table('users')->get(),
                'products' => DB::table('products')->get(),
                'customers' => DB::table('customers')->get(),
                'credits' => DB::table('credits')->get(),
                'stocks' => DB::table('stocks')->get(),
                'roles' => DB::table('roles')->get(),
                'activity_logs' => DB::table('activity_logs')->get()
            ];
            
            Storage::put("backups/{$filename}", json_encode($backup, JSON_PRETTY_PRINT));
            
            ActivityLog::log('backup_created', null, null, "Database backup created: {$filename}");
            
            return response()->json([
                'message' => 'Backup created successfully',
                'filename' => $filename,
                'timestamp' => $timestamp
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Backup failed: ' . $e->getMessage()], 500);
        }
    }
    
    public function listBackups()
    {
        $files = Storage::files('backups');
        $backups = collect($files)->map(function($file) {
            return [
                'filename' => basename($file),
                'size' => Storage::size($file),
                'created_at' => Storage::lastModified($file)
            ];
        });
        
        return response()->json($backups);
    }
    
    public function downloadBackup($filename)
    {
        if (!Storage::exists("backups/{$filename}")) {
            return response()->json(['error' => 'Backup file not found'], 404);
        }
        
        return Storage::download("backups/{$filename}");
    }
}
