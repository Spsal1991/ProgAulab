<button class="btn btn-primary " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
    aria-controls="offcanvasWithBothOptions">Enable both scrolling & backdrop</button>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="form-floating">
            <form method="GET" action="{{ route('products.index') }}">

                <select class="form-select" id="floatingSelect" aria-label="Ordina per:">
                    <option selected value="desc">Dal più economico al più costoso</option>
                    <option value="asce">Dal più costoso al più economico</option>
                </select>
                <label for="floatingSelect">Ordina per:</label>
                <button type="submit">Cerca</button>
            </form>
        </div>
        <ul>
            <li>
                <label for="">
                    Prezzo Minimo
                    <input type="number">
                </label>

            </li>
            <li>
                <label for="">
                    Prezzo Massimo
                    <input type="number">
                </label>
            </li>
        </ul>
    </div>
</div>
