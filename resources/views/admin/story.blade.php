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
                                <h5>Stories</h5>
                                <div class="d-inline-flex">
                                    <a href="{{ route('admin.add.story') }}" class="align-items-center btn btn-theme d-flex">
                                        <i data-feather="plus-square"></i>Add Story
                                    </a>
                                </div>
                            </div>
                            <div>
                                @include('components.messagebox')
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 50px">No</th>
                                                <th style="min-width: 50px">Part</th>
                                                <th style="min-width: 100px">Title</th>
                                                <th style="min-width: 100px">Title Japanese</th>
                                                <th style="min-width: 300px">Body</th>
                                                <th style="min-width: 300px">Body Japanese</th>
                                                <th style="min-width: 300px">Image</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($lists as $key => $list)
                                                <tr>
                                                    <td style="text-align:center">
                                                        {{ $ttl + 1 - ($lists->firstItem() + $key) }}
                                                    </td>
                                                    <td data-label="part">
                                                        @if ($list->part == 1)
                                                        {{ 'First' }}
                                                        @elseif ($list->part == 2)
                                                        {{ 'Second' }}
                                                        @elseif ($list->part == 3)
                                                        {{ 'Third' }}
                                                        @elseif ($list->part == 4)
                                                        {{ 'Last' }}
                                                        @else
                                                        {{ 'Title' }}
                                                        @endif
                                                    </td>
                                                    <td style="text-align:left;">
                                                        {{ $list->title }}
                                                    </td>
                                                    <td style="text-align:left;">
                                                        {{ $list->title_jp }}
                                                    </td>
                                                    <td style="text-align:left;">
                                                        @if (mb_strlen($list->body) > 50)
                                                            {!! mb_substr($list->body, 0, 50) .
                                                                '<br>' .
                                                                mb_substr($list->body, 50, 50) !!}
                                                                @if (mb_strlen(mb_substr($list->body, 100) > 0))
                                                                {{ ' ...' }}
                                                                @endif
                                                        @else
                                                            {!! nl2br(e($list->body)) !!}
                                                        @endif
                                                    </td>
                                                    <td style="text-align:left;">
                                                        @if (mb_strlen($list->body_jp) > 30)
                                                            {!! mb_substr($list->body_jp, 0, 30) .
                                                                '<br>' .
                                                                mb_substr($list->body_jp, 30, 30) !!}
                                                                @if (mb_strlen(mb_substr($list->body_jp, 60) > 0))
                                                                {{ ' ...' }}
                                                                @endif
                                                        @else
                                                            {!! nl2br(e($list->body_jp)) !!}
                                                        @endif
                                                    </td>
                                                    <td style="text-align:center;">
                                                        @if (!empty($list->image))
                                                            <img src="{{ asset('images/' . $list->image) }}"
                                                                alt="thumb" style="width: 50px;height: 50px;">
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href='{{ url('/editstory/' . $list->id) }}'>
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>
                                                            @if ($list->part != 0)
                                                            <li>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteConfirmModal{{ $list->id }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </td>
                                                </tr>
                                                {{-- Delete confirm Modal Start--}}
                                                <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal{{ $list->id }}"
                                                    aria-hidden="true" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-block text-center">
                                                                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="remove-box">
                                                                    <p>This story will be deleted.</p>
                                                                </div>
                                                            </div>
                                        
                                                            <div class="modal-footer">
                                                                <form method="POST" action="{{ route('admin.delete.story') }}" style="display:flex;">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $list->id }}">
                                                                    <button type="submit"class="btn btn-animation btn-md fw-bold me-2"
                                                                        data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                                                        data-bs-dismiss="modal">Yes</button>
                                                                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                                                        style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Delete confirm Modal End --}}
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