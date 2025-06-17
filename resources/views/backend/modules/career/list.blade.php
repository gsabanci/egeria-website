@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Kariyer İçerik</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıdaki alanda kariyer sayfası içeriklerini
                düzenleyebilirsiniz.</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <!-- Success GELİCEK-->

    <div class="card-body py-0">
        <!--begin::Table-->
        <form action="{{ route('admin.career_content_update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-5">
                <input type="hidden" value="{{ $career_content->content_guid }}" name="content_guid">
                <label for="inputEmail4">Başlık</label>
                <input type="text" name="title" value="{{ $career_content->title }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputPassword4">Altyazı</label>
                <textarea id="kt_summernote_2" class="summernote" type="text" name="subtitle" class="form-control">{{ $career_content->subtitle }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Kaydet</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">Geri</a>
            </div>
        </form>
    </div>
</div>
<!--end::Table-->
</div>
<!--end::Body-->

</div>
@section('js')
    <script>
        var KTSummernoteDemo = function() {
            // Private functions
            var demos = function() {
                $('.summernote').summernote({
                    minHeight: 300
                });
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            KTSummernoteDemo.init();
        });
    </script>
    <script>
        var KTSummernoteDemo1 = function() {
            // Private functions
            var demos = function() {
                $('.summernote').summernote({
                    minHeight: 300
                });
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            KTSummernoteDemo.init();
        });
    </script>
@endsection
