<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">{{ config('app.name', 'Inventory System') }}</a>, All Rights Reserved.
            </div>
            <div class="col-12 col-sm-6 text-center text-sm-end">
                <div class="d-inline">
                    <a class="text-muted" href="{{ route('privacy') }}">Privacy Policy</a> |
                    <a class="text-muted" href="{{ route('terms') }}">Terms & Conditions</a>
                </div>
                <div class="mt-2 mt-sm-0 d-inline">
                    <span class="text-muted">v{{ config('app.version', '1.0.0') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->