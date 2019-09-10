<?php

namespace App\Services;

use App\Models\Quote;

class QuotesService
{
    /**
     * Get all Quotes
     *
     * @return Quote
     */
    public function getAll()
    {
        return Quote::all();
    }
    
    /**
     * Get all active Quotes
     *
     * @return Quote
     */
    public function getAllActive()
    {
        return Quote::enabled()->get();
    }

    /**
     * Get all active Quotes by locale
     *
     * @param $locale
     * @return Quote
     */
    public function getAllActiveByLocale($locale)
    {
        return Quote::enabled()->where('locale', $locale)->get();
    }

    /**
     * Get all active Quotes
     *
     * @param $count
     *
     * @return Quote
     */
    public function getActiveByLimit($count)
    {
        return Quote::enabled()->limit($count)->get();
    }
    
    /**
     * Get by all fields
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id):Quote
    {
        return Quote::findOrFail($id);
    }
    
    /**
     * The method prepares the array. Array to show in DataTTables.
     * Return an array. Array keys are keys for DataTables
     *
     * @param $limit
     * @param $start
     * @param $order
     * @param $dir
     * @param $search
     * @param $draw
     * @return array
     */
    public function getDataTableData($limit, $start, $order, $dir, $search, $draw):array
    {
        $columns = [
            0 => 'id',
            1 => 'enabled',
            2 => 'locale',
            3 => 'title',
            4 => 'text',
            5 => 'author'
        ];
        
        $data = [];
        
        # Total number of records in the array
        $totalFiltered = $totalData = Quote::count();
        
        $limit = $limit == -1 ? $totalData : $limit;
        
        $order = $columns[$order];
        
        # Get all the entries
        if(empty($search))
        {
            $quotes = Quote::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        } else {
            $quotes =  Quote::where('title', 'LIKE', "%{$search}%")
                ->orWhere('text', 'LIKE', "%{$search}%")
                ->orWhere('author', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        
            $totalFiltered = Quote::where('title', 'LIKE', "%{$search}%")
                ->orWhere('text', 'LIKE', "%{$search}%")
                ->orWhere('author', 'LIKE', "%{$search}%")
                ->count();
        }

        foreach ($quotes as $key => $item)
        {
            $nestedData['index']   =  $key + 1;
            $nestedData['locale']  =  $item->locale;
            $nestedData['title']   =  $item->title;
            $nestedData['text']    =  $item->text;
            $nestedData['author']  =  $item->author;
            $nestedData['id']      =  $item->id;
            $nestedData['edit']    =  route('quotes.edit', ['id' => $item->id]);
            $nestedData['delete']  =  route('quotes.delete', ['id' => $item->id]);
            $nestedData['enabled'] =  $item->enabled;
            
            $data[] = $nestedData;
        }
        
        $result = [
            'draw'            => intval($draw),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            'data'            => $data
        ];
        return $result;
    }
    
    /**
     * Update and save value in a field "enabled"
     *
     * @param int $id
     * @return Quote
     */
    public function switchStatus(int $id):Quote
    {
        $quote = Quote::findOrFail($id);
        $quote->enabled = !$quote['enabled'];
    
        $quote->save();
        
        return $quote;
    }
    
    /**
     * The method of create new object
     *
     * @param array $data
     *
     * @return Quote
     */
    public function store(array $data):Quote
    {
        $quote = Quote::createQuote($data);
    
        $quote ->save();

        return $quote;
    }
    
    /**
     * The method updating existing object
     *
     * @param array $data
     *
     * @return Quote
     *
     */
    public function edit(array $data):Quote
    {
        $quote = $this->getById($data['id']);
    
        $quote->editQuote($data);
    
        $quote ->save();
        return $quote;
    }
    
    /**
     * Delete item object
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $quote = $this->getById($id);
        $quote->delete();
    }
}