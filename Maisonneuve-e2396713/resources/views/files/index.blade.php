@extends('layout')

@section('title', 'Liste des Fichiers')

@section('content')
<div class="container mt-5">
    <h1>{{ __('messages.files_list') }}</h1>

    <!-- Ajouter un fichier -->
    <div class="mb-3">
        <a href="{{ route('files.create') }}" class="btn btn-primary">
            {{ __('messages.add_file') }} 
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tableau des fichiers -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('messages.title') }}</th>
                <th>{{ __('messages.uploaded_by') }}</th>
                <th>{{ __('messages.date') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr>
                    <!-- Affichage du titre en français ou en anglais selon la langue -->
                    <td>{{ app()->getLocale() == 'fr' ? $file->title_fr : $file->title_en }}</td>
                    <td>{{ $file->user->name }}</td>
                    <td>{{ $file->created_at->format('d/m/Y') }}</td>
                    <td>
                        <!-- Actions pour visualiser ou supprimer -->
                        <a href="{{ Storage::url($file->path) }}" class="btn btn-info" target="_blank">{{ __('messages.view') }}</a>

                        @if(Auth::id() == $file->user_id)
                            <a href="{{ route('files.edit', $file->id) }}" class="btn btn-warning">{{ __('messages.edit') }}</a>
                            <form action="{{ route('files.destroy', $file->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $files->links() }}
</div>
@endsection
