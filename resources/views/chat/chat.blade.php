<!DOCTYPE html>
@extends('layouts.main')
@section('meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('navTitle', 'Chat')
@section('subMenu')
  <div>
    @include('components/partials/sidebar_sumaho')
  </div>
@endsection
@section('content')
  <div class="flex flex-col max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="-m-1.5 overflow-x-auto">
      <div class="flex border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
        {{-- サイドバー --}}
        <div>
          @include('components/partials/sidebar')
        </div>

        <div class="content ms-3 me-3 flex-grow">
          @foreach ($otherUsers as $other)
            <div id="vertical-tab-with-border-{{ $other->id }}" class="hidden" role="tabpanel"
              aria-labelledby="vertical-tab-with-border-item-{{ $other->id }}">
              <button id="scrollButton-{{ $other->id }}"
                class="w-full lg:py-3 lg:px-4 py-2 px-2 mb-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                スクロールを一番下に
              </button>

              <div id="message-display-{{ $other->id }}"
                class="message-display lg:max-h-[400px] max-h-[300px] overflow-y-scroll">

                @foreach ($allMessages as $message)
                  @if (
                      ($message->user_id == $user_id && $message->recipients->contains('user_id', $other->id)) ||
                          ($message->user_id == $other->id && $message->recipients->contains('user_id', $user_id)))
                    @if ($message->user_id == $user_id)
                      <div class="flex justify-start w-full">
                        <div
                          class="mt-1 mb-1 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800">
                          <p>{{ $message->message }}</p>
                        </div>
                      </div>
                    @else
                      <div class="flex justify-end w-full">
                        <div
                          class="mt-1 mb-1 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-100 text-teal-800">
                          <p>{{ $message->message }}</p>
                        </div>
                      </div>
                    @endif
                  @endif
                @endforeach
              </div>
              <!-- 送信フォーム -->
              <div class="fixed bottom-0 left-0 right-0 bg-white p-4 max-w-[85rem] mx-auto px-4">
                <form method="post" action="{{ route('chat.send') }}"
                  onsubmit="onsubmit_Form(event, {{ $other->id }});" class="">
                  @csrf
                  <button type="submit" class="text-white bg-blue-700 px-5 py-2">送信</button>
                  <textarea id="input_message_{{ $other->id }}" name="message" autocomplete="off" class="w-full lg:h-20 py-2"></textarea>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

@push('bottomScript')
  @include('components/script/chat/chat')
@endpush
