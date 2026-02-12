def main():
    numeros = []
    while len(numeros) < 3:
        try:
            linea = input()
            numeros.extend(linea.split())
        except EOFError:
            break

    if len(numeros) >= 2:
        a = int(numeros[0])
        b = int(numeros[1])
        c = int(numeros[2])
        print(a + b + c)

if __name__ == "__main__":
    main()