
@if ($notice_ttlpage > 0)
<!-- Pagination -->
{{-- <div style="bottom:28px"> --}}
<div style="bottom:28px">
    <nav class="custom-pagination">
        <ul class="pagination justify-content-center">

            @php if(empty($_GET['page']))$_GET['page']=1; $set=ceil($_GET['page']/5);@endphp
            @php $page=($_GET['page']); $ppage=($_GET['page']-1); $npage=($_GET['page']+1);@endphp

            <li @if($_GET['page'] < 2) style="display: none" @endif class="page-item"><a class="page-link" id="nextLink" href="{{ request()->fullUrlWithQuery(['page' => $ppage]) }}">  <i class="fa-solid fa-angles-left"></i></a></li>

            @php

            if($page<3){
                $k=0;
            }elseif($page>($notice_ttlpage-2)){
                $k=$notice_ttlpage-5;
            }else{
                $k=($page-3);
            };

            if($k<0){
                $k=0;
            }


            @endphp

            <!-- {{ $k }} -->
            @for ($i = ($k)+1; $i <= (($k)+6); $i++)
                @if($i<=$notice_ttlpage)
                    @if($i < (($k)+6))
                    <li class="page-item @if($_GET['page'] == $i) active @endif"><a id="nextLink" class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{$i}}</a></li>
                    @endif
                @endif
            @endfor

            <li @if($_GET['page'] == $notice_ttlpage) style="display: none" @endif class="page-item"><a id="nextLink" class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $npage]) }}"> <i class="fa-solid fa-angles-right"></i></a></li>

        </ul>
     </nav>
  </div>
</div>
@endif
