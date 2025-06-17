<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <input id="themeSwitch" data-switch="true" type="checkbox" data-on-text="light" data-handle-width="30"
                data-off-text="dark" data-on-color="dark" data-off-color="dark" data-label-text="Tema"
                {{ $theme->status == 0 ?  '' : 'checked' }} />
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->

        <!--end::Nav-->
    </div>

    <!--end::Container-->
</div>
@section('js')


@endsection
