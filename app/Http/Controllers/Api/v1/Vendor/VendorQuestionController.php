<?php

namespace App\Http\Controllers\Api\v1\Vendor;

use App\Helpers\MethodHelper;
use App\Models\Product\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\Vendor\VendorFilterRequest;

class VendorQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Question::whereIn('product_id', MethodHelper::getVendorProductIds());

        $search_columns = ["title", "product_id", "customer_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->with('product', 'customer')->orderBy('id', 'desc')->paginate(10);
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Question $my_question)
    {

        $data = $my_question->load('product', 'customer');
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    public function update(QuestionRequest $request, Question $my_question)
    {
        try {
            $validated = $request->validated();
            $my_question->update([
                'answer' => $validated['answer']
            ]);
            return $this->successResponse('Question Answered Successfully', ['question' => $my_question]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $my_question)
    {

        $my_question->delete();
        return $this->successResponse('Data Deleted Successfully', ['question' => null]);
    }
}
