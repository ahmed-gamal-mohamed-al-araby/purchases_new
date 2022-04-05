@php
$currentLanguage = app()->getLocale();
// $currentIndex = $suppliers->firstItem();
@endphp

<table id="example" class="table table-bordered table-striped text-center sort-table">
    <thead>
        <tr style="text-align:center;">
            <th> @lang('site.id')</th>
            <th> @lang('site.name_supplier') @lang('site.en') </th>
            <th> @lang('site.name_supplier') @lang('site.ar') </th>
            <th> @lang('site.type') </th>
            <th> @lang('site.nat_tax_number') </th>
            <th> @lang('site.status') </th>
            <th> @lang('site.actions') </th>
        </tr>
    </thead>
    <tbody>

        @foreach($suppliers as $index => $supplier)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{$supplier->name_en}}</td>
            <td>{{$supplier->name_ar}}</td>
            <td>@lang("site.$supplier->type")</td>
            <td>{{$supplier->nat_tax_number}}</td>
            <td>
                @if ($supplier->approved == 0)
                <span class="text-danger"> @lang('site.reviewing')</span>
                @else
                <span class="text-success"> @lang('site.reviewed')</span>
                @endif
            </td>
            <td>
                {{-- <a href="{{route("supplier.edit",$supplier->id)}}" class="btn btn-sm btn-info">
                <i class="fa fa-eye"></i>
                </a> --}}
                @if($supplier->id!=1)

                <a href="{{route("supplier.edit",$supplier->id)}}" class="btn btn-sm btn-success">
                    <i class="fa fa-edit"></i>
                </a>
                @if(Auth::user()->id == 12 || Auth::user()->id == 13 || Auth::user()->id == 2)

                <a href="{{route("supplier.delete",$supplier->id)}}" class="btn btn-sm btn-danger">
                    <i class="fa fa-trash"></i></a>
                @if($supplier->approved==0)
                <a class="btn btn-success" href="{{route("approve_supplier",$supplier->id)}}" role="button">Approve</a>
                @endif

                @endif

                @endif



            </td>
        </tr>
        @endforeach
    </tbody>
</table>