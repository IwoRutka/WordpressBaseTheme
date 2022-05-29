<form action="/" method="get">
    
    <label for="search">Szukaj</label>
    <input type="text" name="s" id="search" value="<?php the_search_query();?>" required>
    <button type="submit">Szukaj</button>

</form>