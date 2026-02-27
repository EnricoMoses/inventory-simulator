
    <form class="grid grid-cols-1 md:grid-cols-2 gap-4" action="" method="POST" enctype="multipart/form-data" class="">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                      -
                    </label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" name="" placeholder="">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                     -
                    </label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="" name="">
                </div>

                 <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                       -
                    </label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="" name="">
                </div>

                <div>
                     <label class="block text-sm font-medium text-gray-600 mb-1">
                       -
                    </label>
                    <select name="" class="form-select border border-yellow-700 rounded-lg px-3 py-2" required>
                            <option value="" disabled selected>Default(null)</option>
                            <option value=""></option>
                            <option value="" ></option>

                        </select>
                </div>

                 <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                     -
                    </label>
                   <input type="file" name="" class="border border-gray-300 rounded-lg px-3 py-2 file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:bg-gray-500 file:text-white">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                    -
                    </label>
                    <textarea class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" name="" placeholder=""></textarea>
                </div>

                <div class="md:col-span-2 flex gap-3 mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                        Save
                    </button>

                    <button type="reset" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">
                        Clear
                    </button>
                </div>

            </form>
