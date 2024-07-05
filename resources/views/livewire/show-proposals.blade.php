<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
              <table class="min-w-full">
                <thead class="border-b">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      #
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Customer Name
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Construction of
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Created By
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Created at
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Updated at
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($proposals as $proposal)
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $proposal->customer_name }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $proposal->construction_of }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $proposal->user->name }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $proposal->created_at }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $proposal->updated_at }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                
                                <form id="delete-form-{{ $proposal->id }}" action="{{ route('proposal.destroy', ['proposal' => $proposal->id]) }}" method="POST" onclick="confirmAction(event, 'delete-form-{{ $proposal->id }}')">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                {{-- Edit  --}}
                                <a href="{{ route('proposal.edit',['proposal' => $proposal->id]) }}"><x-button type="button">Edit</x-button></a>

                                {{-- Delete Button --}}
                                <span class="deleteButton" data-id="{{$proposal->id}}"><x-button style="background-color: tomato" type="button">Delete</x-button></span>

                                {{-- Print Button --}}
                                <span class="PrintButton" data-url="{{route('proposal.print',['proposal' => $proposal->id])}}" type="button" data-id="{{$proposal->id}}"><x-button style="background-color: blue" type="button">Export PDF</x-button></span>


                                {{-- Hidden User name for alert --}}
                                <input type="text" hidden value="{{$proposal->user->name}}" id="name_{{$proposal->id}}">

                            </td>


                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="my-3">
                {{ $proposals->links() }}
            </div>
          </div>
        </div>
    </div>

</div>
