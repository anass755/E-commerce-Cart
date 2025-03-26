
<x-frontend-layout>

<div class="container" style="margin-top:10%">
    <form action="{{ route('contact.show') }}" method="post">
        @csrf
        @method('head')
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
        </div>
        <div class="form-group">
            <label for="content">Example textarea</label>
            <textarea class="form-control" id="content" name="content"></textarea>
        </div>
            <button class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
 
</x-frontend-layout>

