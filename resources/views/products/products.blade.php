@extends('layouts.master')
@section('css')
@endsection
@section('title')
    المنتجات
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">اضافة منتج</a>



                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0"> اسم المنتج</th>
                                    <th class="border-bottom-0"> القسم</th>
                                    <th class="border-bottom-0"> ملاحظات</th>
                                    <th class="border-bottom-0">العمليات </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($products as $product)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->Product_name }}</td>
                                        <td>{{ $product->section->section_name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $product->id }}"
                                                data-product_name="{{ $product->Product_name }}"
                                                data-section_name="{{ $product->section->section_name }}"
                                                data-description="{{ $product->description }}" data-toggle="modal"
                                                href="#updateProduct" title="تعديل"><i class="las la-pen"></i></a>



                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $product->id }}"
                                                data-product_name="{{ $product->Product_name }}" data-toggle="modal"
                                                href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- //add form --}}
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافة منتج </h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('products.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                                <input class="form-control" name="product_name" id="product_name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">القسم</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="" selected disabled>--حدد القسم--</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">ملاحظات:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- close add form --}}


        {{-- //update form --}}
        <div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="products/update" method="post" autocomplete="off">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                                <input class="form-control" name="product_name" id="product_name" type="text">
                            </div>
                            <select name="section_name" id="section_name" class="form-control">
                                @foreach ($sections as $section)
                                    <option>{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">ملاحظات:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- //close update form --}}

        {{-- delete form --}}
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="products/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
        {{-- close delete form --}}
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script>
        $('#updateProduct').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        });

        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
        })
    </script>
@endsection
