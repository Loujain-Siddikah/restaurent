<div class="modal fade" id="{{ $id }}" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="{{ $formMethod }}" action="{{ $formAction }}" id="{{ $formId }}" name="{{ $methodName }}">
                @csrf
                @if ($methodName == 'delete')
                    @method('delete') 
                @endif
                <div class="modal-body">
                    {{ $body }}
                </div>
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            </form>
        </div>
    </div>
</div>
