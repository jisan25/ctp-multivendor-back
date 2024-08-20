<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Models\Product\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorFilterRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Question::query()->with('product.category', 'customer');


        $search_columns = ["title", "product_id", "customer_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $question = $question->load('product', 'customer');
        return $this->successResponse('Data Retrieved Successfully', ['question' => $question]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return $this->successResponse('Question deleted successfully', ['question' => null]);
    }
}
