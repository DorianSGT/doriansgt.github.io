def main():
    numeros = []

    while len(numeros) < 2:
        try:
            linea = input()
            numeros.extend(linea.split())
        except EOFError:
            break

    if len(numeros) >= 2:
        a = int(numeros[0])
        b = int(numeros[1])
        print(a + b)

if __name__ == "__main__":
    main()