String.prototype.masked = function(m) {
    var m, l = (m = m.split("")).length, s = this.split(""), j = 0, h = "";
    for(var i = -1; ++i < l;)
        if(m[i] != "#"){
            if(m[i] == "\\" && (h += m[++i])) continue;
            h += m[i];
            i + 1 == l && (s[j - 1] += h, h = "");
        }
        else{
            if(!s[j] && !(h = "")) break;
            (s[j] = h + s[j++]) && (h = "");
        }
    return s.join("") + h;
};

String.prototype.isCNPJ = function() {
	var cnpj = this, numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
	if (cnpj.length == 0) {
		return false;
	}
	
	cnpj = cnpj.replace(/\D+/g, '');
	digitos_iguais = 1;

	for (i = 0; i < cnpj.length - 1; i++)
		if (cnpj.charAt(i) != cnpj.charAt(i + 1)) {
			digitos_iguais = 0;
			break;
		}
	if (digitos_iguais)
		return false;
	
	tamanho = cnpj.length - 2;
	numeros = cnpj.substring(0,tamanho);
	digitos = cnpj.substring(tamanho);
	soma = 0;
	pos = tamanho - 7;
	for (i = tamanho; i >= 1; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
	}
	resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	if (resultado != digitos.charAt(0)){
		return false;
	}
	tamanho = tamanho + 1;
	numeros = cnpj.substring(0,tamanho);
	soma = 0;
	pos = tamanho - 7;
	for (i = tamanho; i >= 1; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
	}

	resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	
	return (resultado == digitos.charAt(1));
}