#!/bin/env fish

set ticket 'portailCollab$TICKET_e02e23462a541c2da0c737b8134fdfd42ddfc24b';

function help
    printf "Usage: ./dl_file [OPTIONS] [files-list]\n\n"
    printf "Options:\n"
    printf "  -h/--help       Prints help and exits\n"
    printf "  -d/--dest=path  String of dest path (default to ~/FMEC/nxt/compression-tests)"

    return 0
end

function dl_file --description "Download files from Ged"
  set --local options 'h/help' 'd/dest';

  argparse $options -- $argv
    printf $argv
  if set --query _flag_help; help; end

  set --query _flag_dest; or set _flag_dest ~/FMEC/nxt/compression-tests;
  
  dl -d $_flag_dest $argv
  echo -e "\nnow : "(ls $_flag_dest | wc -l)" files"
end

function dl
    set --local options 'd/dest=';
    argparse $options -- $argv

    for file in $argv;
        set str (string split . $file) && set uuid $str[1] && set ext $str[2];

        echo "uuid: $uuid"
        curl --location \
            --request GET 'http://ged-ws.fiducial.dom:8080/proxy/GetContent' \
            --header "uuid: $file" \
            --header "ticket: $ticket" \
            --header 'Authorization: Basic cG9ydGFpbENvbGxhYjp1Z0dOejlocERVV2FCbzBmMHpzbw==' >> $_flag_dest/$uuid.$ext 
    ; end
end

dl_file $argv
