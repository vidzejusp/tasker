@props(['formAction' => false])

<div>
    @if($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
            @csrf
            @endif
            <div class="px-4 py-4">
                @if(isset($title))
                    <span class="text-lg leading-6 font-medium text-gray-900">
                        {{ $title }}
                    </span>
                @endif
                @if(isset($status))
                        {{ $status }}
                @endif
            </div>
            <div class="border-t border-gray-200 bg-white">
                {{ $content }}
            </div>

            <div class="bg-gray-50 px-4 py-5 sm:px-4 sm:flex justify-end border-t border-gray-200 items-center">
                {{ $buttons }}
            </div>
    @if($formAction)
        </form>
    @endif
</div>

{{--<div class="flex h-screen">--}}
{{--    <div class="m-auto">--}}
{{--        <div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">--}}
{{--            <div class="flex flex-row">--}}
{{--                <div class="px-2">--}}
{{--                    <svg width="24" height="24" viewBox="0 0 1792 1792" fill="#44C997" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M1299 813l-422 422q-19 19-45 19t-45-19l-294-294q-19-19-19-45t19-45l102-102q19-19 45-19t45 19l147 147 275-275q19-19 45-19t45 19l102 102q19 19 19 45t-19 45zm141 83q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <div class="ml-2 mr-6">--}}
{{--                    <span class="font-semibold">Successfully Saved!</span>--}}
{{--                    <span class="block text-gray-500">Anyone with a link can now view this file</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
