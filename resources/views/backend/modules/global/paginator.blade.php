@php
$total_records = $paginator->total();
$per_page = $paginator->perPage();
$last_page = $paginator->lastPage();
$current_page = $paginator->currentPage();
$has_more_pages = $paginator->hasMorePages();
$next_page_url = $paginator->nextPageUrl();
$previous_page_url = $paginator->previousPageUrl();
@endphp

@if (($total_records - $per_page) > 0)
<!--begin::Pagination-->
<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex flex-wrap py-2 mr-3">
        @if($current_page > 1)
        <a href="{{ $paginator->url(1) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
            <i class="ki ki-bold-double-arrow-back icon-xs"></i>
        </a>
        <a href="{{ $previous_page_url }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
            <i class="ki ki-bold-arrow-back icon-xs"></i>
        </a>
        @endif

        <a href="{{ $paginator->url($current_page) }}" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">{{ $current_page }}</a>
        
        @if($has_more_pages > 0)
            @for($i = $current_page;$i < $last_page; $i++) 
            <a href="{{ $paginator->url($i + 1) }}" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">{{ $i + 1 }}</a>
            @endfor
            
            
            <a href="{{ $next_page_url }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                <i class="ki ki-bold-arrow-next icon-xs"></i>
            </a>
            @if ($current_page > 0 && $current_page != $last_page)
            <a href="{{ $paginator->url($last_page) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                <i class="ki ki-bold-double-arrow-next icon-xs"></i>
            </a>
            @endif
        @endif
    </div>

</div>
<!--end:: Pagination-->
@endif