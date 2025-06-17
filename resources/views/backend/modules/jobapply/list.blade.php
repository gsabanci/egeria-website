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
            <span class="card-label font-weight-bolder text-dark">Bütün İş Başvuruları</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıda sistemde yer alan bütün iş başvuruları
                görebilirsiniz.</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        @if(count($jobapplies) > 0)
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                <thead>
                    <tr class="text-left">
                        <th style="max-width: 30px">ID</th>
                        <th style="min-width: 200px">Adı Soyadı</th>
                        <th style="min-width: 200px">Ofis</th>
                        <th style="min-width: 200px">Telefon</th>
                        <th style="min-width: 50px">CV</th>
                        <th style="min-width: 50px">Başvuru Tarihi</th>
                        <th class="pr-0 text-right pr-3" style="min-width: 160px">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobapplies as $job)
                    <tr {!! $job->readed === '0' ? 'class="table-primary"' : null !!}>
                        <td>#{{ $job->id }}</td>
                        <td>
                            <span
                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $job->fullname }}</span>
                            <span class="text-muted font-weight-bold">{{ $job->job_detail->title  }}</span>
                        </td>
                        <td>
                            @php
                                $offices = [];
                                foreach($job->job_detail->offices as $of) {
                                    $offices[] = $of->office->title;
                                }
                                $officenames = implode(", ",$offices);
                            @endphp
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $officenames }}</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $job->phone }}</span>
                        </td>
                        <td>
                            @if(!is_null($job->cv))
                                <a href="{{ asset('storage/cv/'.$job->cv) }}" target="_blank">İndir</a>
                            @else
                                <i class="flaticon2-cross text-danger"></i>
                            @endif
                        </td>
                        <td>{{ $job->created_at }}</td>
                        <td class="pr-0 text-right pr-2">
                            <a href="{{ route('admin.jobapply_read',$job->ja_guid) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="1267.000000pt"
                                        height="1280.000000pt" viewBox="0 0 1267.000000 1280.000000"
                                        preserveAspectRatio="xMidYMid meet">
                                        <metadata>
                                            Created by potrace 1.15, written by Peter Selinger 2001-2017
                                        </metadata>
                                        <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)"
                                            fill="#2196f3" stroke="none">
                                            <path d="M11845 12790 c-652 -50 -1136 -233 -1477 -558 -181 -172 -869 -991
                                            -1414 -1682 -1090 -1382 -2308 -3110 -3507 -4975 -99 -154 -200 -304 -224
                                            -333 -85 -99 -184 -147 -243 -117 -100 52 -256 380 -485 1025 -122 343 -191
                                            473 -306 573 -158 138 -353 150 -679 41 -334 -111 -740 -375 -890 -579 -147
                                            -199 -154 -343 -41 -800 101 -405 404 -1332 597 -1820 88 -222 260 -576 334
                                            -688 60 -91 159 -200 210 -232 82 -51 172 -63 560 -74 535 -15 778 18 984 133
                                            130 73 152 100 541 686 1993 2997 4026 5709 6302 8406 290 344 405 488 470
                                            592 55 88 92 176 93 218 0 72 -85 142 -205 169 -84 19 -452 28 -620 15z" />
                                                                                        <path d="M5955 12083 c-765 -36 -1413 -173 -2086 -438 -627 -248 -1215 -601
                                            -1738 -1043 -168 -142 -571 -545 -710 -711 -811 -965 -1276 -2070 -1398 -3321
                                            -21 -219 -24 -787 -5 -995 76 -827 284 -1552 648 -2254 555 -1070 1433 -1963
                                            2512 -2555 655 -360 1436 -615 2176 -711 873 -113 1761 -47 2593 194 838 242
                                            1632 671 2311 1246 179 152 564 541 717 725 1182 1419 1642 3228 1279 5030
                                            -181 899 -598 1784 -1196 2541 -27 34 -28 34 -46 14 -15 -15 -461 -533 -549
                                            -636 -12 -15 -1 -33 93 -155 553 -719 838 -1510 904 -2518 14 -208 14 -664 0
                                            -836 -81 -1030 -465 -1997 -1114 -2805 -582 -724 -1366 -1292 -2243 -1624
                                            -1237 -468 -2622 -464 -3855 10 -400 154 -755 341 -1113 588 -476 327 -922
                                            763 -1268 1239 -268 367 -512 830 -667 1263 -597 1664 -286 3508 824 4894 418
                                            522 959 979 1541 1303 1019 566 2167 780 3425 636 515 -58 960 -190 1425 -420
                                            82 -40 152 -70 156 -66 37 42 539 694 539 700 0 9 -317 165 -445 220 -488 210
                                            -1007 353 -1545 427 -365 50 -841 74 -1165 58z" />
                                        </g>
                                    </svg>

                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="{{ route('admin.jobapply_delete',$job->ja_guid) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-secondary">
        Sistemde kayıtlı bir iş başvurusu bulunmamaktadır.
        </div>
        @endif
        <!--end::Table-->
    </div>
    <!--end::Body-->
    @if($jobapplies->lastPage() > 1)
    <div class="card-footer">
        {{ $jobapplies->links('backend.modules.global.paginator', ['paginator' => $jobapplies]) }}
    </div>
    @endif
</div>