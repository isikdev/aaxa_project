use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Регистрация
Route::post('register', [AuthController::class, 'register']);

// Авторизация
Route::post('login', [AuthController::class, 'login']);

// Сброс пароля
Route::post('password/reset', [AuthController::class, 'resetPassword']);
