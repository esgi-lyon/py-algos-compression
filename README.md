# Algo
> **Etudes sur les algorithmes de compression **

## 0. Requis

- `python 3.x`

## 1. Install

- `conda` package manager recommanded (installed over miniconda)

## Install

- Required `conda` package manager [(download windows)](https://repo.anaconda.com/miniconda/Miniconda3-latest-Windows-x86_64.exe)
- Add more packages channels : `conda config --add channels conda-forge`
- Create env :
```sh
conda create -y --name research python=3.8 --file research/requirements.txt
```

- Launch : `conda activate research`
- Switch python interpreter to this env on Vscode bottom left
- (Optional) Jupyter notebook : `jupyter notebook --generate-config`
- To stop venv : `conda deactivate`

> For more on conda : [Here the cheatseet](https://docs.conda.io/projects/conda/en/4.6.0/_downloads/52a95608c49671267e40c689e0bc00ca/conda-cheatsheet.pdf)

## Ressources

- algo dictionnaire dynamique :
    - [`zstd`](https://github.com/facebook/zstd)
    - `lzma` multi thread

- algo dictionnaire statique
    - [`brotli`](https://github.com/google/brotli)
    - [`deflate`](https://github.com/ebiggers/libdeflate) (partie de la zlib)
