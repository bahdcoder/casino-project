@extends('layouts.app')


@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.24.6/jsoneditor.min.css">
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Games</div>

                <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <div id="alertBox" class="alert"></div>
                      </div>
                    </div>
                    <div class="row">
                      <table class="table">
                        <thead>
                          <tr>
                            <td>#</td>
                            <td>Edit</td>
                            <td>Settings</td>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($games as $game)
                          <tr>
                            <td>{{ $game->id }}</td>
                            <td>
                              <button id="editSettings-{{ $game->id }}" onclick="handleEditSettings({{ $game->id }}, {{ $game->settings }})" class="btn btn-xs btn-info edit-button">Edit Settings</button>
                            </td>
                            <td>
                              <code id="gameSettings-{{ $game->id }}">
                                {{ $game->settings }}
                              </code>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="row col-md-6 col-md-offset-3">
                      <div id="jsoneditor"></div>
                    </div>
                    <div class="row my-5 action-buttons">
                      <div class="col-md-12 my-5 text-center">
                        <button id="saveSettings" class="btn btn-info">Save Settings</button>
                        <button id="cancelEditing" class="btn btn-danger">Cancel</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.24.6/jsoneditor.min.js"></script>
  <script>
    window.__GAME__ID__ = "{{ $game->id }}"
    window.__CSRF__TOKEN__ = "{{ csrf_token() }}"

  </script>
  <script src="{{ asset('js/editor.js') }}"></script>
@endsection
