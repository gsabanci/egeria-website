@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{session('success')}}
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger" role="alert">
  {{session('error')}}
</div>
@endif
<div class="card card-custom">
  <!--begin::Header-->
  <div class="card-header border-0 py-5">
    <h3 class="card-title align-items-start flex-column">
      <span class="card-label font-weight-bolder text-dark">E-bülten Aboneleri</span>
      <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıdaki listede kayıtlı e-bülten abonelerini görebilirsiniz.</span>
    </h3>
  </div>
  <!--end::Header-->
  <!--begin::Body-->
  <div class="card-body py-0">
    <!--begin::Table-->
    @if(count($subscribers) > 0)
    <div class="table-responsive">
      <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
        <thead>
          <tr class="text-left">
            <th style="max-width: 10px">ID</th>
            <th style="min-width: 200px">E-mail</th>
            <th class="pr-0 text-right" style="min-width: 160px">İşlemler</th>
          </tr>
        </thead>
        <tbody>
          @foreach($subscribers as $n)
          <tr>
            <td>#{{ $n->id }}</td>
            <td>
              <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $n->email }}</span>
              <span class="text-muted font-weight-bold"></span>
            </td>
            <td class="pr-0 text-right">
              <a href="#" data-toggle="modal" data-target="#delete_{{ $n->subscription_guid }}"
                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"></rect>
                      <path
                        d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                        fill="#000000" fill-rule="nonzero"></path>
                      <path
                        d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                        fill="#000000" opacity="0.3"></path>
                    </g>
                  </svg>
                  <!--end::Svg Icon-->
                </span>
              </a>
            </td>
          </tr>
       
          <div class="modal" id="delete_{{ $n->subscription_guid }}" tabindex="-1" role="dialog">
            <form action="{{ route('admin.subscriber_delete') }}" method="POST">
              @csrf
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Takipçi Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p> {{ $n->email }} takipçisini silmek istediğinize emin misiniz?</p>
                  </div>
                  <input type="hidden" name="subscription_guid" value="{{ $n->subscription_guid }}">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Sil</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          @endforeach
        
        </tbody>
      </table>
    </div>
    @else
    <div class="alert alert-secondary">
      Sistemde kayıtlı abone bulunmamaktadır.
    </div>
    @endif
    <!--end::Table-->
  </div>
  <!--end::Body-->
  @if($subscribers->lastPage() > 1)
  <div class="card-footer">
    {{ $subscribers->links('backend.modules.global.paginator', ['paginator' => $subscribers]) }}
  </div>
  @endif
</div>