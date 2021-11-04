<x-app>
   <div class="formBox">
    <div class="card">
        <div class="card-header">
            Upload Your Excel File
        </div>
        <div class="card-body">
            <form action="{{route('points.import')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="excel" id="" class="form-control">
                <div class="text-center mt-2">
                    <button type="submit" class="btn">upload</button>
                </div>
            </form>
        </div>
    </div>
   </div>
</x-app>