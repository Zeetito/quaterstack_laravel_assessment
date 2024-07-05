
<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="mb-4">
        <h2 class="underline text-center font-medium text-4xl">Aggrement</h2>
    </div>
    <form id="proposal-edit-form" >
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-label for="work_to_be_performed">
                    Work to be Performed
                </x-label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="work_to_be_performed" rows="5" wire:model="work_to_be_performed">
                    
                </textarea>
            </div>
            <div class="mb-4">
                <x-label for="customer">
                    Customer
                </x-label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="customer" rows="5" wire:model="customer">
                    
                </textarea>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="mb-4">
                <x-label for="customer_name">
                    Customer Name
                </x-label>
                <x-input id="customer_name" class="border w-full py-2 px-3 outline-none" wire:model="customer_name" />
                @error('customer_name') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-label for="construction_of">
                    Construction of
                </x-label>
                <x-input id="construction_of" class="border w-full py-2 px-3 outline-none" wire:model="construction_of" />
                @error('construction_of') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <hr />
        <ul id="sortable-list" wire:sortable="updateOrder">
            <li wire:sortable.item="" wire:key="item-overseas_conditions">
                <div>
                    <x-proposal-input-group :array="$overseas_conditions"  title="Conditions For Overseas Installations" variable="overseas_conditions"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-base">
                    
                    <x-proposal-input-group :array="$base" title="Base" variable="base"/>
                </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-court_preparation">
                <div>
                    <x-proposal-input-group :array="$court_preparation"  title="Court Preparation" variable="court_preparation"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-surfacing">
                <div>
                    <x-proposal-input-group :array="$surfacing"  title="Surfacing" variable="surfacing"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-fence">
                <div>
                    <x-proposal-input-group :array="$fence"  title="Fence" variable="fence"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-lights">
                <div>
                    <x-proposal-input-group :array="$lights"  title="Lights" variable="lights"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-court_accessories">
                <div>
                    <x-proposal-input-group :array="$court_accessories"  title="Court Accessories" variable="court_accessories"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-fee">
                <div>
                    <x-proposal-input-group :array="$fee"  title="Fee" variable="fee"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-provisions">
                <div>
                    <x-proposal-input-group :array="$provisions"  title="Provisions" variable="provisions"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-conditions">
                <div>
                    <x-proposal-input-group :array="$conditions"  title="Conditions" variable="conditions"/>
                </div>
            </li>
            <hr />

            <li wire:sortable.item="" wire:key="item-guarantee">
                <div>
                    <x-proposal-input-group :array="$guarantee"  title="Guarantee" variable="guarantee"/>
                </div>
            </li>

        </ul>

        <hr />
        <div>
            <x-proposal-input-group :array="$credit"  title="Credit" variable="credit"/>
        </div>

        <hr />
        <div class="my-4">
            <x-label for="send_proposal_to">
                Send Proposal To
            </x-label>
            <x-input type="text" id="send_proposal_to" class="border w-full py-2 px-3 outline-none" wire:model="send_proposal_to" placeholder="Enter email address"/>
            @error('send_proposal_to') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="my-4 flex justify-center">
            {{-- Update Submit button --}}
            <x-button type="submit" class="bg-green-500  hover:bg-green-800 mx-3" >Update Proposal</x-button>
    
            {{-- Delete Button --}}
            <span><x-button  class="deleteButton bg-red-500  hover:bg-green-800 mx-3" type="button"  data-id="{{$proposal->id}}">Delete</x-button></span>
    
            {{-- Print Button --}}
            <span class="PrintButton bg-red-500  hover:bg-green-800 mx-3" data-url="{{route('proposal.print',['proposal' => $proposal->id])}}" data-id="{{$proposal->id}}"><x-button type="button" style="background-color: blue" >Export PDF</x-button></span>
    
            {{-- Send PDF --}}
            <span class="SendPDFButton  bg-red-500  hover:bg-green-800 mx-3" data-url="{{route('proposal.send',['proposal' => $proposal->id])}}" data-id="{{$proposal->id}}"><x-button  type="button" style="background-color: blue" >Send PDF</x-button></span>
        </div>

    </form>


     {{-- Hidden User name for alert --}}
     <input type="text" hidden value="{{$proposal->user->name}}" id="name_{{$proposal->id}}">
        <form id="delete-form-{{ $proposal->id }}" action="{{ route('proposal.destroy', ['proposal' => $proposal->id]) }}" method="POST" onclick="confirmAction(event, 'delete-form-{{ $proposal->id }}')">
            @csrf
            @method('DELETE')
            
            <input type="hidden" id="signature-data" name="signature_data" required>
        </form>

    <p>Signature</p>
    <div>
        <canvas id="signature-pad" width="400" height="200" style="border:1px solid #000000;"></canvas>
    </div>


    <button type="button" id="clear_signature" >ClearSignature</button>
    <p id="error_message" style="color:red"></p>

</div>

