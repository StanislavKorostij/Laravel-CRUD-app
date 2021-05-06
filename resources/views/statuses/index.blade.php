<x-app-layout>
    <x-slot name="header">
		<div class="overflow-x-auto mt-6 h-auto">
			@if(session()->has('message'))
				<div class="flex items-center justify-center">
						<h4 class="flex justify-center font-bold items-center h-8 px-4 sm:w-1/2 lg:w-1/4 w-full m-2 text-sm text-white rounded-lg bg-green-600">{{ session()->get('message') }}</h4>
				</div>
				<br>
			@endif
			@if($errors->any())
			<div class="flex w-full justify-center">
				<h4 class="flex font-bold items-center h-8 px-4 m-2 text-xs sm:text-sm text-white rounded-lg bg-red-500">{{$errors->first()}}</h4>
			</div>
			<br>
			@endif
			<table class="table-auto border-collapse w-full">
				<thead>
					<tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
						<th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Status</th>
						<th class="px-4 py-2 " style="background-color:#f8f8f8">Actions</th>
					</tr>
				</thead>

				<tbody class="text-sm font-normal text-gray-700">
					@foreach ($statuses as $statuses)
					<tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
						<td class="px-4 py-4">{{ $statuses->name }}</td>
						<td>
							<form class="px-4 py-2" action={{ route('statuses.destroy', $statuses->id) }} method="POST">
								<a class="inline-flex font-bold items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-600" href={{ route('statuses.edit', $statuses->id) }}>Edit</a>
								@csrf @method('delete')
								<input onclick="return confirm('Are you sure?')" type="submit" class="inline-flex font-bold items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-red-600 rounded-lg outline-none hover:bg-red-700 cursor-pointer" value="Delete"/>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>
				<div>
					<a href="{{ route('statuses.create') }}" class="inline-flex font-bold items-center h-8 px-4 m-2 text-white transition-colors duration-150 bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-600">Add</a>
				</div>
	</x-slot>
</x-app-layout>