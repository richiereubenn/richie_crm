@props([
    'id',
    'title',
    'buttonText',
    'buttonColor' => 'blue',
    'label' => 'Note',
    'placeholder' => 'Enter note...'
])

<div
    data-twe-modal-init
    data-twe-backdrop="static"
    data-twe-keyboard="false"
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="{{ $id }}"
    tabindex="-1"
    aria-labelledby="{{ $id }}Label"
    aria-hidden="true">
    <div
        data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
                <h5 class="text-xl font-medium leading-normal text-surface" id="{{ $id }}Label">
                    {{ $title }}
                </h5>
                <button
                    type="button"
                    class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none"
                    data-twe-modal-dismiss
                    aria-label="Close">
                    <span class="[&>svg]:h-6 [&>svg]:w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Form -->
            <form id="{{ $id }}Form" method="POST">
                @csrf
                <div class="relative p-4" data-twe-modal-body-ref>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
                    <textarea 
                        name="approval_note" 
                        rows="4"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-{{ $buttonColor }}-500"
                        placeholder="{{ $placeholder }}" 
                        required></textarea>
                </div>

                <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4">
                    <button
                        type="button"
                        class="inline-block rounded bg-gray-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-gray-700 transition duration-150 ease-in-out hover:bg-gray-200"
                        data-twe-modal-dismiss
                        data-twe-ripple-init
                        data-twe-ripple-color="light">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="ms-1 inline-block rounded bg-{{ $buttonColor }}-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-{{ $buttonColor }}-700"
                        data-twe-ripple-init
                        data-twe-ripple-color="light">
                        {{ $buttonText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>