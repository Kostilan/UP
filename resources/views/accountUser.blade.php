<h1>Обо мне</h1>
<form action="/account/accountUserUpdate" method="POST">
    @csrf
    <div class="form-div">
        <label for="surname" class="form-label">Фамилия</label>
        <input type="text" class="form-input" id="" name="surname" value="{{ $user->surname }}">
        @error('surname')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-div">
        <label for="name" class="form-label">Имя</label>
        <input type="text" class="form-input" id="" name="name" value="{{ $user->name }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-div">
        <label for="patronymic" class="form-label">Отчество</label>
        <input type="text" class="form-input" id="" name="patronymic" value="{{ $user->patronymic }}">
        @error('patronymic')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-div">
        <label for="login" class="form-label">Логин</label>
        <input type="text" class="form-input" id="" name="login" value="{{ $user->login }}">
        @error('login')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-div">
        <label for="email" class="form-label">Почта</label>
        <input type="email" class="form-input" id="" name="email" value="{{ $user->email }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-div">
        <label for="birthday" class="form-label">Дата рождения</label>
        <input type="date" class="form-input" id="" name="birthday" value="{{ $user->birthday }}">
        @error('birthday')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-div">
        <label for="phone" class="form-label">Телефон</label>
        <input type="number" class="form-input" id="" name=phone value="{{ $user->phone }}">
        @error('phone')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
