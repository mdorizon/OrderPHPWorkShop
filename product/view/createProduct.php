<?php require_once './order/view/partials/header.php'; ?>

<main class="d-flex justify-content-center vh-80 mt-5">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 500px; height: fit-content;">
        <h2 class="text-center mb-4">Créer un produit</h2>
        <form method="POST" action="http://localhost:8888/workshopmethodo/process-create-product">
            <div class="mb-3">
                <label for="title" class="form-label">Titre du produit</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="un titre rapide entre 3 et 100 caractères" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Lien de l'image</label>
                <input type="url" class="form-control" name="image" id="image" placeholder="https://">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" class="form-control" name="price" id="price" min="3" max="500" step="0.01" placeholder="2€ par défault !">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" placeholder="décris rapidement le produit, ces spécificitées"></textarea>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="isActive" id="isActive">
                <label class="form-check-label" for="isActive">Le produit est-il actif par défaut ?</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Créer</button>
        </form>
    </div>
</main>

<?php require_once './order/view/partials/footer.php'; ?>