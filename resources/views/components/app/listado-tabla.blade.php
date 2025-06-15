{{-- <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger --> --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $titulo }}</h3>
        @if ($search)            
        <div class="card-tools">
            <form action="{{ $search->route }}" method="get">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="{{ $search->placeholder }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @endif
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    @foreach($columns as $field)
                        <th>{{ $field->text }}</th>
                    @endforeach
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        @foreach($columns as $key => $field)
                            <td>{{ isset($field->getter) ? ($field->getter)($item) : $item->{$key} }}</td>
                        @endforeach
                        <td>
                            @foreach($actions as $action)
                                <a href="{{ route($action['route'], $item) }}" class="btn btn-sm btn-{{ $action['class'] }}">
                                    <i class="fas fa-{{ $action['icon'] }}"></i> {{ $action['label'] }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) }}" class="text-center">{{ $emptyMessage }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>