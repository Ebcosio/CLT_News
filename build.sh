#!/usr/bin/env bash

# Clean up from previous builds
rm -rf ./build/ || true # ignore error if dir does not exist

# Make directories into which we copy. Having named dirs for zip
# to add to the archive file gives us consistent directory names,
# which WP can recognize for purposes of saving plugin settings, etc.
mkdir -p build/clt-news
mkdir -p build/Baskervillechild

# Copy everything over to build (see above as to why)
cp -r ./Baskervillechild/* ./build/Baskervillechild
cp -r ./clt-events/* ./build/clt-news

# Create plugin and theme zip files
cd build # need to go into dir so archive dir structure doesn't start at `build`
zip -r -q ./clt-news.zip ./clt-news/*
zip -r -q ./Baskervillechild.zip ./Baskervillechild/*

# remove file copies for clarity
rm -rf ./Baskervillechild
rm -rf ./clt-news

# cd back to root dir for completeness
cd ..

echo "DONE! Check the ./build directory for plugin and theme zip files"

exit 0
