@extends('backend.layouts.master')
@section('title','Form Ayarları - Yönetici Paneli')

@section('content')
    <div class="row">
        <div class="col-xl-12">
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
                        <span class="card-label font-weight-bolder text-dark">Form Ayarları</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıdaki alandan site içi form gönderim ayarlarını düzenleyebilirsiniz.</span>
                    </h3>
                </div>
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                          <thead>
                            <tr class="text-left">
                              <th style="max-width: 30px">Ayar Adı</th>
                              <th style="max-width: 30px">Değeri</th>
                              <th class="pr-0 text-right" style="width: 90px"></th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($settings as $s)
                                <form action="{{ route('admin.form_setting_update') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ss_guid" value="{{ $s->ss_guid }}">
                                    <tr>
                                        <td>{{ $s->label }}</td>
                                        <td>
                                            <input type="text" class="form-control" name="s_value" value="{{ $s->s_value }}" required>
                                        </td>
                                        <td class=" text-right">
                                            <button class="btn btn-icon btn-sm btn-primary">
                                                <i class="menu-icon flaticon2-checkmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                              @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection