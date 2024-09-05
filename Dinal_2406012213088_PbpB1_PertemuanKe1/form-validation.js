function generateCaptcha() {
    const captcha = Math.random().toString(36).substring(2, 7);
    document.getElementById("captcha").value = captcha;
}

function validateForm() {
    const productName = document.getElementById("productName").value;
    const description = document.getElementById("description").value;
    const category = document.getElementById("category").value;
    const subCategory = document.getElementById("subCategory").value;
    const price = document.getElementById("price").value;
    const wholesaleYes = document.getElementById("wholesaleYes").checked;
    const wholesalePrice = document.getElementById("wholesalePrice").value;
    const shippingOptions = document.querySelectorAll('input[name="shipping"]:checked');
    const captcha = document.getElementById("captcha").value;
    const captchaInput = document.getElementById("captchaInput").value;

    if (productName.length < 5 || productName.length > 30) {
        alert("Nama produk harus diisi, minimal 5 karakter, maksimal 30 karakter");
        return false;
    }

    if (description.length < 5 || description.length > 100) {
        alert("Deskripsi produk harus diisi, minimal 5 karakter, maksimal 100 karakter");
        return false;
    }

    if (category === "") {
        alert("Kategori harus diisi");
        return false;
    }

    if (subCategory === "") {
        alert("Sub kategori harus diisi sesuai dengan kategori yang dipilih");
        return false;
    }

    if (isNaN(price) || price === "") {
        alert("Harga satuan harus diisi, berupa nilai numerik");
        return false;
    }

    if (wholesaleYes && (isNaN(wholesalePrice) || wholesalePrice === "")) {
        alert("Harga grosir harus diisi jika pilihan Grosir adalah Ya, berupa nilai numerik");
        return false;
    }

    if (shippingOptions.length < 3) {
        alert("Minimal jasa kirim yang dipilih adalah 3");
        return false;
    }

    if (captcha !== captchaInput) {
        alert("Captcha tidak sesuai");
        return false;
    }

    alert("Form submitted successfully!");
    return true;
}

function updateSubCategory() {
    const category = document.getElementById("category").value;
    const subCategory = document.getElementById("subCategory");

    subCategory.innerHTML = "";

    if (category === "Baju") {
        subCategory.innerHTML += '<option value="Baju Pria">Baju Pria</option>';
        subCategory.innerHTML += '<option value="Baju Wanita">Baju Wanita</option>';
        subCategory.innerHTML += '<option value="Baju Anak">Baju Anak</option>';
    } else if (category === "Elektronik") {
        subCategory.innerHTML += '<option value="Mesin Cuci">Mesin Cuci</option>';
        subCategory.innerHTML += '<option value="Kulkas">Kulkas</option>';
        subCategory.innerHTML += '<option value="AC">AC</option>';
    } else if (category === "Alat Tulis") {
        subCategory.innerHTML += '<option value="Kertas">Kertas</option>';
        subCategory.innerHTML += '<option value="Map">Map</option>';
        subCategory.innerHTML += '<option value="Pulpen">Pulpen</option>';
    }
}
