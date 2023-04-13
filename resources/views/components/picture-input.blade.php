<div class="flex mb-4" x-data="imagePreview()">
    <div class="mr-3">
        <img
             id="preview"
             src="{{ isset(Auth::user()->profile_image) ? Auth::user()->image_url : asset('images/user_icon.png') }}"
             class="object-cover w-16 h-16 bg-gray-200 border-none rounded-full">
    </div>
    <div class="flex items-center">
        <button
                x-on:click="document.getElementById('image').click()"
                type="button"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 uppercase bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 active:outline-none active:ring-2 active:ring-orange-400 active:ring-offset-2 active:text-gray-500 active:bg-gray-50 focus:ring-orange-400">
            アイコンを設定
        </button>
        <input @change="showPreview(event)" type="file" name="image" id="image" class="hidden">
        <script>
            function imagePreview() {
                return {
                    showPreview: (event) =>{
                        if(event.target.files.length > 0){
                            var src = URL.createObjectURL(event.target.files[0]);
                            document.getElementById('preview').src = src;
                        }
                    }
                }
             }
        </script>
    </div>
</div>
