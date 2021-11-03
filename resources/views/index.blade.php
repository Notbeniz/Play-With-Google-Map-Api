<x-app>

   <div class="w-25 m-auto pt-5">
    <form action="{{route('points.import')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel" id="" class="form-control">
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-info">upload</button>
        </div>
    </form>
   </div>
</x-app>