function loadAccounts(category = '') {

    let url = '/api/accounts';

    if (category) {
        url += '?category=' + category;
    }

    fetch(url)
        .then(res => res.json())
        .then(data => {
            let html = '';

            data.forEach(acc => {
                html += `
                    <div class="service-box account">
                        <h6>${acc.title}</h6>
                        <small>${acc.username}</small>
                        <p class="price">${Number(acc.price).toLocaleString()}đ</p>
                        <small>${acc.category.name}</small>
                    </div>
                `;
            });

            document.getElementById('account-list').innerHTML = html;
        });
}