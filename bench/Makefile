SHELL:=/bin/bash

MODE:=tar php
# brotli gzip lzma b2zip
ALGOS:=br gz xz bz2
# executables
exe.br=brotli
exe.xz=xz
exe.bz2=bzip2
exe.gz=gzip
# Add more folders to compare more sizes
SIZES:= $(shell ls batchs)
COMP_LEVEL?=5
LOG:= >> results-$(COMP_LEVEL).md;
# Markdown
HEADER_TH:=| Algo / test | comp (ms) | size (Mo) | gain (Mo) | decomp (ms) |\r
HEADER_SEP:=|:----------:|:---------:|:---------:|:---------:|:-----------:|
HEADER:=$(HEADER_TH)$(HEADER_SEP)

.DEFAULT_GOAL := help
.PRECIOUS: $(MODE)

$(MODE): % : %

bench_cmd= D=$$(date +%s%3N);\
		   eval '$(1);'; \
		   echo -en "|\t$$((($$(date +%s%3N)-D)))\t" $(LOG)

get_du=$$(du -m $(1) | cut -f1)

winned=echo -en "|\t$$(expr $(call get_du, batchs/$*) - $(call get_du, $(RENDER)))\t\t" $(LOG)

render_size=echo -en "|\t$(call get_du, $(RENDER) )\t\t" $(LOG)

%.tar:
	@echo -e "##### $* / $(call get_du, batchs/$*)Mo" $(LOG)
	@echo -e "$(HEADER)" $(LOG)
	@$(foreach algo, $(ALGOS), \
		echo -en "|\t$(algo)\t\t" $(LOG)\
		$(MAKE) -s $*.tar.algo ALGO=$(algo) ; echo "|" $(LOG) \
	)
	@echo -e "\r\n"

tar: clean-tar clean
	@$(foreach size, $(SIZES), $(shell make $(size).tar);))

%.tar.algo: check-algo %.results
	@$(call bench_cmd, tar cvf - batchs/$* | $(exe.$(ALGO)) -$(COMP_LEVEL) - > $(RENDER) )
	@$(call render_size)
	@$(call winned)
	@$(call bench_cmd, brotli -d $(RENDER) )

%.results: clean-tar
	mkdir -p results/$*
	@echo "[ ---- Testing Size $* ---- ]"
	$(eval RENDER:=results/$*/$(COMP_LEVEL).tar.$(ALGO))

%.php.algo: check-algo %.results-php
	@$(call bench_cmd, ./php/$(ALGO)-comp.php '$*')
	@$(call render_size)
	@$(call winned)
	@$(call bench_cmd, ./php/$(ALGO)-decomp.php '$*')

%.results-php: clean-zip
	mkdir -p results/$*
	@echo "[ ---- Testing $* in php ---- ]"
	$(eval LOG:= >> results-php-$(COMP_LEVEL).md;)
	$(eval RENDER:=results/$*/php.$(COMP_LEVEL).$(ALGO))

check-algo:
	@$(if $(ALGO),\
	echo "[ ---- Compress with $(ALGO) ---- ]";,\
	echo "Error no algo set" && exit 1;\
	)

clean:
	rm -rf results/**/**
	rm -rf results-$(COMP_LEVEL).md

clean-%:
	rm -rf results/**/$(COMP_LEVEL).$*

rsync:
	rsync -r \
	-e "ssh -p 2222" \
	$(PWD)/ vagrant@localhost:/data/compression-tests

help: ## Display this help message
	@echo "Default compression level : $(COMP_LEVEL)"
	@echo -e "Upload sources in vagrant : make rsync"
	@echo -e "Full tar Test : export COMP_LEVEL=9 && make tar" 
	@echo "[ === All possible size commands === ]"
	@echo -e "$(strip \
	$(foreach algo,$(ALGOS),\
		$(foreach size,$(SIZES),\
			make $(size).tar.$(algo)\\n\
		)\
	)")
