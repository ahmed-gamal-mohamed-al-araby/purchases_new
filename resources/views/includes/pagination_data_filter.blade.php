@php
$envPaninationLength = env('PAGINATION_LENGTH', 5);
$envPaninationLengthFilter = json_decode(env('PAGINATION_LENGTH_FILTER'), true) ?? [5, 10, 25, 50, -1];
@endphp
<div class="custom_dataTables_wrapper">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="dataTables_length text-left" id="table_records_length">
                <label>@lang('site.Show') <select name="table_records_length" aria-controls="datatableTemplate"
                        class="custom-select custom-select-sm form-control form-control-sm">
                        @foreach ($envPaninationLengthFilter as $envPaninationLength)
                            @if ($loop->last)
                                <option value="-1">@lang('site.All')</option>
                            @else
                                <option value="{{ $envPaninationLength }}">{{ $envPaninationLength }}</option>
                            @endif
                        @endforeach
                    </select> @lang('site.Records')</label>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div id="datatableTemplate_filter" class="dataTables_filter"><label><i class="fa fa-filter"
                        aria-hidden="true"></i><input type="search" name="search" class="form-control form-control-sm"
                        placeholder="@lang('site.Search')" aria-controls="datatableTemplate"></label>
                <label>
                    <button id="search-content" type="button" class="btn btn-success py-1">@lang('site.Search')</button>
                </label>
            </div>
        </div>
    </div>
</div>
