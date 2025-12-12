<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Показать все автомобили (главная страница)
    public function index()
    {
        $cars = Car::latest()->get();
        return view('cars.index', compact('cars'));
    }

    // Показать форму создания
    public function create()
    {
        return view('cars.create');
    }

    // Сохранить новый автомобиль (с валидацией)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'color' => 'required|string|max:30',
            'body_type' => 'required|string|in:Седан,Универсал,Хэтчбек,Внедорожник,Купе,Минивэн,Пикап',
            'detailed_description' => 'required|string|min:10',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp,bmp|max:5120'
        ], [
            // Кастомные сообщения об ошибках на русском
            'brand.required' => 'Поле "Марка" обязательно для заполнения.',
            'brand.max' => 'Марка не должна превышать 50 символов.',
            'model.required' => 'Поле "Модель" обязательно для заполнения.',
            'model.max' => 'Модель не должна превышать 50 символов.',
            'year.required' => 'Поле "Год" обязательно для заполнения.',
            'year.integer' => 'Год должен быть целым числом.',
            'year.min' => 'Год должен быть не ранее 1900.',
            'year.max' => 'Год не может быть в будущем.',
            'mileage.required' => 'Поле "Пробег" обязательно для заполнения.',
            'mileage.integer' => 'Пробег должен быть целым числом.',
            'mileage.min' => 'Пробег не может быть отрицательным.',
            'color.required' => 'Поле "Цвет" обязательно для заполнения.',
            'color.max' => 'Цвет не должен превышать 30 символов.',
            'body_type.required' => 'Поле "Тип кузова" обязательно для заполнения.',
            'body_type.in' => 'Выберите корректный тип кузова из списка.',
            'detailed_description.required' => 'Поле "Подробное описание" обязательно для заполнения.',
            'detailed_description.min' => 'Описание должно содержать не менее 10 символов.',
            'image.mimes' => 'Разрешены только изображения форматов: jpeg, jpg, png, gif, webp, bmp.',
            'image.max' => 'Размер изображения не должен превышать 5 МБ.',
        ]);

        // Обработка изображения
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $safeName = str_replace([' ', '_'], '-', $originalName);
            $imageName = time() . '_' . $safeName . '.' . $extension;
            
            $path = $image->storeAs('cars', $imageName, 'public');
            $validated['image'] = $path;
        }

        // Создаем автомобиль
        Car::create($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Автомобиль успешно добавлен!');
    }

    // Показать детальную информацию об автомобиле
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // Показать форму редактирования
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Обновить автомобиль (с валидацией)
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'color' => 'required|string|max:30',
            'body_type' => 'required|string|in:Седан,Универсал,Хэтчбек,Внедорожник,Купе,Минивэн,Пикап',
            'detailed_description' => 'required|string|min:10',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp,bmp|max:5120'
        ], [
            // Кастомные сообщения об ошибках на русском
            'brand.required' => 'Поле "Марка" обязательно для заполнения.',
            'brand.max' => 'Марка не должна превышать 50 символов.',
            'model.required' => 'Поле "Модель" обязательно для заполнения.',
            'model.max' => 'Модель не должна превышать 50 символов.',
            'year.required' => 'Поле "Год" обязательно для заполнения.',
            'year.integer' => 'Год должен быть целым числом.',
            'year.min' => 'Год должен быть не ранее 1900.',
            'year.max' => 'Год не может быть в будущем.',
            'mileage.required' => 'Поле "Пробег" обязательно для заполнения.',
            'mileage.integer' => 'Пробег должен быть целым числом.',
            'mileage.min' => 'Пробег не может быть отрицательным.',
            'color.required' => 'Поле "Цвет" обязательно для заполнения.',
            'color.max' => 'Цвет не должен превышать 30 символов.',
            'body_type.required' => 'Поле "Тип кузова" обязательно для заполнения.',
            'body_type.in' => 'Выберите корректный тип кузова из списка.',
            'detailed_description.required' => 'Поле "Подробное описание" обязательно для заполнения.',
            'detailed_description.min' => 'Описание должно содержать не менее 10 символов.',
            'image.mimes' => 'Разрешены только изображения форматов: jpeg, jpg, png, gif, webp, bmp.',
            'image.max' => 'Размер изображения не должен превышать 5 МБ.',
        ]);

        // Обработка нового изображения
        if ($request->hasFile('image')) {
            // Удаляем старое изображение если оно есть
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            
            $image = $request->file('image');
            
            // Безопасное имя файла
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $safeName = str_replace([' ', '_'], '-', $originalName);
            $imageName = time() . '_' . $safeName . '.' . $extension;
            
            $path = $image->storeAs('cars', $imageName, 'public');
            $validated['image'] = $path;
        } else {
            // Если новое изображение не загружено - сохраняем старое
            $validated['image'] = $car->image;
        }

        // Обновляем автомобиль
        $car->update($validated);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Автомобиль успешно обновлен!');
    }

    // Удалить автомобиль (мягкое удаление)
    public function destroy(Car $car)
    {
        // Удаляем изображение при удалении записи 
        if ($car->image && Storage::disk('public')->exists($car->image)) {
            Storage::disk('public')->delete($car->image);
        }
        
        $car->delete();
        
        return redirect()->route('cars.index')
            ->with('success', 'Автомобиль успешно удален!');
    }
}