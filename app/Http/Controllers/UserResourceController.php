<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Создаем новый запрос к модели User
        $collection = User::query();

        // Получаем список полей, которые можно фильтровать
        $allowedFilterFields = (new User())->getFillable();

        // Определяем список полей, по которым разрешена сортировка
        $allowedSortFields = ['id', ...$allowedFilterFields];

        // Определяем допустимые направления сортировки
        $allowedSortDirections = ['asc', 'desc'];

        // Получаем поле для сортировки из строки запроса, по умолчанию 'id'
        $sortBy = $request->query('sortby', 'id');

        // Получаем направление сортировки из строки запроса, по умолчанию 'asc'
        $sortDir = strtolower($request->query('sortdir', 'asc'));

        // Проверяем, что поле для сортировки допустимо, если нет, используем первое допустимое поле
        if(!in_array($sortBy, $allowedSortFields)) $sortBy = $allowedSortFields[0];

        // Проверяем, что направление сортировки допустимо, если нет, используем первое допустимое направление
        if(!in_array($sortDir, $allowedSortDirections)) $sortBy = $allowedSortDirections[0];

        // Добавляем условие сортировки к запросу
        $collection->orderBy($sortBy, $sortDir);

        // Обрабатываем фильтры из строки запроса
        foreach($allowedFilterFields as $key){
            // Проверяем наличие фильтра в запросе, используя префикс '_'
            if($paramFilter = $request->query('_'.$key)){
                // Экранируем спецсимволы для использования в SQL запросе
                $paramFilter = preg_replace("#([%_?+])#","\\$1",$paramFilter);

                // Добавляем условие фильтрации к запросу
                $collection->where($key, 'LIKE', '%'.$paramFilter.'%');
            }
        }

        // Получаем значение ограничения количества записей из строки запроса, по умолчанию 20
        $limit = intval($request->query('limit', 20));

        // Добавляем ограничение на количество записей в запросе
        $collection->limit($limit);

        // Получаем значение смещения из строки запроса, по умолчанию 0
        $offset = intval($request->query('offset', 0));

        // Убеждаемся, что смещение не отрицательное
        $offset = max($offset, 0);

        // Добавляем смещение к запросу
        $collection->offset($offset);

        // Выполняем запрос и возвращаем результаты
        return $collection->get();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
