
<div class="form-group">

    {{Form::label('title','Product Name')}}

    {{Form::text('title',old('title'),array('class'=>'form-controller'))}}

</div>


<div class="form-group">

    {{Form::label('make',"Manufacturer's Name")}}
    {{Form::text('make',old('make'),array('class'=>'form-controller'))}}

</div>


<div class="form-group">

    {{Form::label('stock',"Number of products in stock")}}
    {{Form::text('stock',old('stock'),array('class'=>'form-controller'))}}

</div>



<div class="form-group">

    {{Form::label('category_id','Category Name')}}
    {{Form::select('category_id',$categories_list,null,array('class'=>'form-controller'))}}

</div>


<div class="form-group">
    {{Form::label('description','Product Description')}}
    {{Form::textarea('description',old('description'),array('class'=>'form-controller'))}}

</div>


<div class="form-group">
    {{Form::label('details','Product Details')}}
    {{Form::textarea('details',old('details'),array('class'=>'form-controller'))}}

</div>

<div class="form-group">
    {{Form::label('image','Upload Product Image')}}
    {{ Form::file('image','',array('id'=>'','class'=>'form-controller')) }}
</div>


<div class="form-group">
    {{Form::label('image1','Upload Product Additional Image 1')}}
    {{ Form::file('image1','',array('id'=>'','class'=>'form-controller')) }}
</div>


<div class="form-group">
    {{Form::label('image2','Upload Product Additional Image 2')}}
    {{ Form::file('image2','',array('id'=>'','class'=>'form-controller')) }}
</div>

<div class="form-group">
    {{Form::label('image3','Upload Product Additional  Image 3')}}
    {{ Form::file('image3','',array('id'=>'','class'=>'form-controller')) }}
</div>


<div class="form-group">
    {{Form::label('price','Price')}}
    <input type="number" name="price"
           pattern="[0-9]+([\.,][0-9]+)?" step="0.01">
</div>


<div class="form-group">
    {{Form::label('is_featured','Featured Product?')}}
    {{Form::select('is_featured', array('1' => 'Yes', '0' => 'No'),null, array('class'=>'form-controller'))}}
</div>


{{Form::submit($productButton, array('class'=>'form-control'))}}