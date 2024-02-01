@extends('layouts.adminMaster')
@section('title')
    Bölümlerin listesi
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="col">
        <div class="row m-4">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSectionModal">
                <i class="fas fa-plus"></i> Bölüm Ekle
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row m-3">
            <div class="card mt-2">
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1 ItemsCheckboxSec shorting ">
                        <div id="empoloyees-tbl_wrapper" class="dataTables_wrapper no-footer">
                            <table id="empoloyees-tbl" class="table dataTable no-footer" role="grid" aria-describedby="empoloyees-tbl_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 91px;">Bölümler
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 161.531px;">Toplam Yemek
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 161.531px;">durum
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 102.156px;">Aksiyon</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @foreach ($sections as $section)
                                        <tr>
                                            <td><span>{{ $section->name }}</span></td>
                                            <td><span>{{ $section->items_count }}</span></td>
                                            <td><span>{{ $section->status }}</span></td>
                                            <td>
                                                <div>
                                                    <a href="" class="btn-link me-1" data-bs-toggle="modal" data-bs-target="#editSectionModal" data-section_id="{{ $section->id }}" data-section_name="{{ $section->name }}" data-section_status="{{ $section->status }}">Düzenle</a>

                                                    <a href="" class="btn-link me-1" data-bs-toggle="modal" data-bs-target="#deleteSectionModal" data-section_id="{{ $section->id }}" data-section_name="{{ $section->name }}">Sil</a>    
                                                </div>
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
    </div>


    <x-modal id="addSectionModal" title="Bölüm Ekle" formAction="{{ route('admin.addSection') }}" formId="addSectionForm" formMethod="POST" methodName="post">
        <x-slot name="body">
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label class="small mb-1" for="inputName">İsim</label>
                    <input class="form-control" id="inputName" type="text" name="name">
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="status">Durum</label>
                    <select name="status" id="status" class="form-control">
                        @foreach(['Yayınla', 'aktif değil'] as $status)
                            <option>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapalı</button>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </x-slot>
    </x-modal>


    <x-modal id="editSectionModal" title="Bölümü düzenle" formAction="{{ route('admin.updateSection') }}" formId="updateSectionForm" formMethod="POST" methodName="post">
        <x-slot name="body">
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label class="small mb-1" for="section_name">İsim</label>
                    <input type="hidden" class="form-control" id="section_id" name="section_id" value="" >
                    <input class="form-control" id="section_name" type="text" name="name" value="">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror                        
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="status">Durum</label>
                    <select name="status" id="status" class="form-control">
                        @foreach(['Yayınla', 'aktif değil'] as $status)
                            <option name="section_status" id="section_status">{{ $status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapalı</button>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </x-slot>
    </x-modal>
    
    <x-modal id="deleteSectionModal" title="Bölümü sil" formAction="{{ route('admin.deleteSection') }}" formId="deleteSectionForm" formMethod="POST" methodName="delete">
        <x-slot name="body">
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <p>Bu bölümü silmek istediğinizden emin misiniz?</p><br>
                    <input name="section_id" id="section_id" value="" type="hidden">
                    <input class="" name="section_name" id="section_name" type="text" readonly>
                </div>
            </div>   
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapalı</button>
            <button type="submit" class="btn btn-primary">Sil</button>
        </x-slot>
    </x-modal>

    <script>
        $(document).ready(function () {
            $('#editSectionModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget)
                    var section_id = button.data('section_id')
                    var section_name = button.data('section_name')
                    var section_status = button.data('section_status')
                    var modal = $(this)
                    modal.find('#updateSectionForm #section_id').val(section_id);
                    modal.find('#updateSectionForm #section_name').val(section_name);
                    modal.find('#updateSectionForm #status').val(section_status);
                    modal.find('#updateSectionForm #status option[value="' + section_status + '"]').prop('selected', true);
                })
            });

        $('#deleteSectionModal').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var section_id = button.data('section_id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('#section_id').val(section_id);
            modal.find('#section_name').val(section_name);
        });


    </script>
@endsection