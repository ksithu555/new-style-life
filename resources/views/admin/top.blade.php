<x-auth-layout>

    <style>
        .table>:not(caption)>*>* {
            border-bottom-width: 0px !important;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>All Top</h5>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 100px">No</th>
                                                <th style="min-width: 100px">Discount</th>
                                                <th style="min-width: 100px">PhaseOne</th>
                                                <th style="min-width: 300px">PhaseTwo</th>
                                                <th style="min-width: 300px">PhaseThree</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($lists as $key => $list)
                                                <tr>
                                                    <td style="text-align:center">
                                                        {{ $ttl + 1 - ($lists->firstItem() + $key) }}</td>
                                                    <td data-label="タイトル">{{ $list->discount }}</td>
                                                    <td style="text-align:left;min-width: 250px">{{ $list->phaseone }}
                                                    </td>
                                                    <td style="text-align:left;min-width: 250px">{{ $list->phasetwo }}
                                                    </td>
                                                    <td style="text-align:left;">
                                                        @if (mb_strlen($list->phasethree) > 30)
                                                            {!! mb_substr($list->phasethree, 0, mb_strlen($list->phasethree) / 2) .
                                                                '<br>' .
                                                                mb_substr($list->phasethree, mb_strlen($list->phasethree) / 2) !!}
                                                        @else
                                                            {!! nl2br(e($list->phasethree)) !!}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href='{{ url('/edittop/' . $list->id) }}'>
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--pagination -->
                @include('components.pagination')
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

</x-auth-layout>
