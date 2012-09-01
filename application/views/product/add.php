<!DOCTYPE html>
<html class="admin">
    <head>
        <?php $this->load->view('common/admin_head');?>
    </head>
    <body>
    <?php $this->load->view('common/admin_header');?>
	<?php echo form_open('admin/product/add'); ?>
	    <h1>Add Product</h1> 
	    <div class="form-input">
		<fieldset>
		    <legend>Product Information</legend>
			<label for="product_id">Product ID</label>
			<input name="product_id" value="<?php if(isset($form_product_id)) echo $form_product_id; ?>" type="text" />*
			<?php echo form_error('product_id', '<span class="form-error-message">', '</span>'); ?>
		    
			<br />
		    <label for="product_name_th">Name (Thai):</label>
		    <input name="product_name_th" value="<?php if(isset($form_product_name_th)) echo $form_product_name_th; ?>" type ="text"/>*
		    <?php echo form_error('product_name_th', '<span class="form-error-message">', '</span>'); ?>
		    
		    <br />
		    <label for="product_name_en">Name (English):</label>
		    <input name="product_name_en" value="<?php if(isset($form_product_name_en)) echo $form_product_name_en; ?>" type ="text"/>*
		    <?php echo form_error('product_name_en', '<span class="form-error-message">', '</span>'); ?>
		   
		    <br />
			<label for="brand_name">Brand:</label>
			<select name="brand_name" > 
				<option value="">--None--</option>
				<?php 
				foreach($brands as $item)
				{  
					if(isset($form_brand_name)&&$form_brand_name==$item->brand_name)
					{
						echo "<option value=".$item->brand_name." selected='selected'>".$item->brand_name."</option>";
					}
					else
					{
						echo "<option value=".$item->brand_name.">".$item->brand_name."</option>";
					}
				}
				?>
		    </select>*
			<?php echo form_error('brand_name', '<span class="form-error-message">', '</span>'); ?>
		    
			<br />
			<label for="cat_id">Category:</label>
			<select name="cat_id" > 
				<option value="">--None--</option>
				<?php 
				foreach($categories as $item)
				{  
					if(isset($form_cat_id)&&$form_cat_id==$item->cat_id)
					{
						echo "<option value=".$item->cat_id." selected='selected'>".$item->cat_name_en."</option>";
					}
					else
					{
						echo "<option value=".$item->cat_id.">".$item->cat_name_en."</option>";
					}
				}
				?>
		    </select>*
			<?php echo form_error('cat_id', '<span class="form-error-message">', '</span>'); ?>
		    
			<br />
			<label for="total_quantity">Total Quantity</label>
			<input name="total_quantity" type="text" value="<?php if(isset($form_total_quantity)) echo $form_total_quantity; else echo'0'; ?>" type="text" type="text"/>*
			<?php echo form_error('total_quantity', '<span class="form-error-message">', '</span>'); ?>
		    
			<br />
			<label for="markup_price">Markup Price</label>
			<input name="markup_price" value="<?php if(isset($form_markup_price)) echo $form_markup_price; ?>" type="text" />*
			<?php echo form_error('markup_price', '<span class="form-error-message">', '</span>'); ?>
		    
			<br />
			<label for="markdown_price">Markdown Price</label>
			<input name="markdown_price" value="<?php if(isset($form_markdown_price)) echo $form_markdown_price; ?>" type="text"  type="text" />
			<br />
		    <label for="description_th">Description (Thai):</label>
		    <textarea name ="description_th" ><?php if(isset($form_description_th)) echo $form_description_th; ?></textarea>
		    <br />
		    <label for="description_en">Description (English):</label>
		    <textarea name ="description_en" ><?php if(isset($form_description_en)) echo $form_description_en; ?></textarea>
		    <br />
			<label for="how_to_wash_th">How to Wash (Thai):</label>
		    <textarea name ="how_to_wash_th" ><?php if(isset($form_how_to_wash_th)) echo $form_how_to_wash_th; ?></textarea>
		    <br />
			<label for="how_to_wash_en">How to Wash (English):</label>
		    <textarea name ="how_to_wash_en" ><?php if(isset($form_how_to_wash_en)) echo $form_how_to_wash_en; ?></textarea>
		
		   
		</fieldset>
	    </div>
	    <div class="content-right form-action">
		<?php echo anchor('admin/product','Cancel' ,array('class' => 'button')); ?>
		<input class="button btn-submit" type = "submit" name="submit" value="Add this product"/>
	    </div>
	</form>
	<?php $this->load->view('common/admin_footer');?>
    </body>
</html>