<x-app-layout>
    <x-slot name="header">
		<div class="container">
			@if($errors->any())
			<div class="flex items-center justify-center">
					<h4 class="flex justify-center font-bold items-center h-8 px-4 w-2/7 m-2 text-sm text-white rounded-lg bg-red-500">{{$errors->first()}}</h4>
			</div>
			@endif
			<br>
			<div class="flex items-center justify-center">
							<div>
									<form action="{{ route('statuses.update', $status->id) }}" method="POST">
										<h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">Edit Status:</h1>
										<br>
										@csrf @method("PUT")
										<div class="mb-4">
											<label class="block text-gray-700 text-sm font-bold mb-2">Name: </label>
											<input type="text" name="name" class="w-full h-10 px-3 mb-2 text-base text-gray-700 placeholder-gray-600 border rounded-lg focus:shadow-outline" value="{{ $status->name }}">
										</div>

										<div class="flex items-center justify-between">
											<button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">Edit</button>
										</div>
									</form>
							</div>
			</div>
		</div>
	</x-slot>
</x-app-layout>