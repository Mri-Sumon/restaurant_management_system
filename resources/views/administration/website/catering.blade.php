@extends('master')
@section('title', 'Speciality Entry')
@section('breadcrumb_title', 'Speciality Entry')
@push('style')
<style>
    .charCount {
        font-size: 12px;
        color: #555;
        float: right;
    }
</style>
@endpush
@section('content')
<div id="catering">
    <div class="row text-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form @submit.prevent="save">
                <fieldset class="scheduler-border bg-of-skyblue">
                    <legend class="scheduler-border">Catering</legend>
                    <div class="control-group">
                        <!-- Title Input -->
                        <div class="form-group clearfix">
                            <div class="col-md-12" style="margin-bottom: 15px;">
                                <label for="title" class="form-label" style="float: inline-start;">Title</label>
                                <input type="text" v-model="title" id="title" name="title" class="form-control" placeholder="Enter title">
                            </div>
                        </div>
                        <!-- Description Textarea -->
                        <div class="form-group clearfix">
                            <div class="col-md-12" style="margin-bottom: 15px;text-align:left">
                                <label for="editor" class="form-label">Description</label>
                                <textarea id="editor" name="description" class="form-control" rows="5" placeholder="Enter description"></textarea>
                            </div>
                        </div>
                        <div class="form-group clearfix" style="margin-top: 10px;">
                            <div class="col-md-12 text-right">
                                @if (userAction('e'))
                                <button type="submit" class="btn btn-primary btn-padding">Update</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    let editor;
    $(document).ready(function() {
        ClassicEditor.create(document.querySelector('#editor'))
            .then(newEditor => {
                editor = newEditor;
            });
    });

    new Vue({
        el: '#catering',
        data: {
            title: '',
            description: ''
        },
        created() {
            this.getCatering();
        },
        methods: {
            getCatering() {
                axios.get('/get-catering')
                    .then(response => {
                        const data = response.data;
                        this.title = data.title || ''; 
                        editor.setData(data.description || ''); 
                    })
                    .catch(error => {
                        toastr.error('Failed to load catering details.');
                    });
            },
            save() {
                const description = editor.getData(); 
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('description', description);

                axios.post('/update-catering', formData)
                    .then(response => {
                        toastr.success(response.data.message);
                        this.getCatering(); 
                    })
                    .catch(error => {
                        const errors = error.response.data.errors;
                        if (errors) {
                            Object.values(errors).forEach(err => toastr.error(err[0]));
                        } else {
                            toastr.error(error.response.data.message || 'An error occurred.');
                        }
                    });
            }
        }
    });
</script>
@endpush
