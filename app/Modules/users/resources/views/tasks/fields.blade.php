<div class="row my-12">
        <div class="col-12">
            <div class="form-group">
                <label> @lang('forms.title') @lang('common.inEn')</label>
                <input type="text" name='title' class="form-control" placeholder="@lang('forms.title')" value="{{ $task->title??(old('title')??'') }}" autocomplete="off" required>
            </div>
        </div>
</div>
<div class="row my-12">
        <div class="col-12">
            <div class="form-group">
                <label> @lang('forms.description') @lang('common.inEn')</label>
                <textarea type="text" name='description' class="form-control" placeholder="@lang('forms.description')" autocomplete="off" required>
               {{ $task->description??(old('description')??'') }}
                </textarea>
            </div>
    </div>
</div>

@if($action == 'edit')
    <div class="form-group col-md-6 col-12">
        {!! Form::label('task', 'Role *:') !!}
        @if($errors->first('task'))
            <br>
            <small class="text-danger">{{$errors->first('task')}}</small>
        @endif
        <select class="form-control selectStatus" required name="user_id">
            <option selected value="" disabled>أختر </option>
            @foreach($users as $user)
            <option value="{{ $user->id}}" @if($task->user_id == $user->id) selected  @endif> {{ $user->name}} </option>
            @endforeach
        </select>
    </div>
@endif
