<div class="p-4">
    <div class="flex space-x">
        <div class="flex flex-col w-1/3">
            <label for="visitDate" class="block">Visitor Date</label>
            <input id="visitDate" name="visitDate" type="text" wire:model.lazy="visitDate" class="form-input">
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="venues">
                Venue
            </label>
            <div class="relative">
                <select wire:change="getVisitors" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="venues" name="venues" wire:model="venue">
                    <option value="">Pick a pub</option>
                    @foreach($venues as $item)
                        <option value="{{ $item->id}}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="venues">
                Visitor
            </label>
            <div class="relative">
                <select wire:change="getSeedList" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="venues" name="venues" wire:model="visitor">
                    <option value="">Pick a visitor</option>
                    @foreach($visitors as $item)
                        <option value="{{ $item->id}}">{{ $item->postcode }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div>
        <p>Total people to be contacted: {{ count($seedList) }}</p>
        <div>
            <label for="exportAs">Export:</label>
            <select name="exportAs" id="exportAs" wire:model="exportType">
                <option value="csv">CSV</option>
                <option value="json">JSON</option>
                <option value="xml">XML</option>
            </select>
            <button wire:click="export">Export</button>
        </div>
    </div>
</div>
