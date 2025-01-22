@if ($ttlpage > 0)
<!-- Pagination -->
<div style="bottom:28px">
    <nav class="custom-pagination">
        <ul class="pagination justify-content-center">
            @php
                if(empty($_GET['page'])) $_GET['page'] = 1;
                $set = ceil($_GET['page'] / 5);
                $page = $_GET['page'];
                $ppage = $_GET['page'] - 1;
                $npage = $_GET['page'] + 1;
                $activeTab = request()->query('tab', 'list'); // Default to 'list' if 'tab' is not set
                if($page < 3) {
                    $k = 0;
                } elseif($page > ($ttlpage - 2)) {
                    $k = $ttlpage - 5;
                } else {
                    $k = $page - 3;
                }
                if($k < 0) {
                    $k = 0;
                }
            @endphp

            <li @if($page < 3) style="display: none" @endif class="page-item">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => 1, 'tab' => $activeTab]) }}">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
            </li>
            <li @if($page < 2) style="display: none" @endif class="page-item">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $ppage, 'tab' => $activeTab]) }}">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </li>

            @for ($i = $k + 1; $i <= $k + 6; $i++)
                @if($i <= $ttlpage)
                    <li class="page-item @if($page == $i) active @endif">
                        <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i, 'tab' => $activeTab]) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endif
            @endfor

            <li @if($page == $ttlpage) style="display: none" @endif class="page-item">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $npage, 'tab' => $activeTab]) }}">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </li>
            <li @if($page == $ttlpage || $page + 1 == $ttlpage) style="display: none" @endif class="page-item">
                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $ttlpage, 'tab' => $activeTab]) }}">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>
@endif