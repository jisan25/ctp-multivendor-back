<?php

namespace App\Http\Controllers\Api\v1\Customer;

use Illuminate\Http\Request;
use App\Helpers\MethodHelper;
use App\Models\Product\Question;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\QuestionRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\Vendor\VendorFilterRequest;

class CustomerQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Question::where('customer_id', Auth::id());

        $filterCols = [];

        $search_columns = ["title"];

        $this->applyFilterSortSearch($filterCols, $search_columns, $query, $request);

        $data = $query->with('product.store')->paginate(10);
        return $this->successResponse('Data Retrieved Successfully', ['customer_questions' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        try {
            $validated = $request->validated();

            $question = Question::create([
                'product_id' => $validated['product_id'],
                'customer_id' => Auth::id(),
                'title' => $validated['title'],
                'answer' => null,
            ]);

            return $this->successResponse('Question Asked Successfully', ['question' => $question]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while asking question.', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $data = $question->load('product.store');
        return $this->successResponse('Data Retrieved Successfully', ['question' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255'
            ]);
            $question->update($validated);
            return $this->successResponse('Data Updated Successfully', ['question' => $question]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return $this->successResponse('Data Deleted Successfully', ['question' => null]);
    }
}
